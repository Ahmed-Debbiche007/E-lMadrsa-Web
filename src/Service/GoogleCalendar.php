<?php

namespace App\Service;


use App\Entity\Events;
use App\Entity\Token;
use App\Entity\Tutorshipsessions;
use Doctrine\ORM\EntityManagerInterface;
use Google_Client;
use Google_Service_Calendar_EventAttendee;

class GoogleCalendar
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function getClient(): Google_Client
    {
        $client = new Google_Client();
        $workdir = substr(getcwd(),0,-6);
        $path = $workdir."src/Service/credentials.json";
        $client->setAuthConfig($path);
        $client->addScope(\Google_Service_Calendar::CALENDAR);
        $redirect_uri = "http://localhost:5000/dashboard/requests/callback";
        $client->setRedirectUri($redirect_uri);

        return $client;
    }

    public function getClientFront(): Google_Client
    {
        $client = new Google_Client();
        $workdir = substr(getcwd(),0,-6);
        $path = $workdir."src/Service/credentials.json";
        $client->setAuthConfig($path);
        $client->addScope(\Google_Service_Calendar::CALENDAR);
        $redirect_uri = "http://localhost:5000/callback";
        $client->setRedirectUri($redirect_uri);

        return $client;
    }

    /**
     * Client with last access token
     * @return Client
     * @throws \Google\Exception
     */
    public function getClientForRequest(): Google_Client
    {
        $allToken = $this->em->getRepository(Token::class)->findAll();
        /** @var Token $token */
        $token = end($allToken);

        $client = $this->getClient();
        $client->setAccessToken($token->getToken());

        return $client;
    }

    /**
     * List all event
     * @return \Google_Service_Calendar_Event[]
     * @throws \Google\Exception
     */
    public function getLastEventCalendar()
    {
        $client = $this->getClientForRequest();
        $service = new \Google_Service_Calendar($client);
        $calendarId = 'primary';
        $opt = [
            'maxResults' => 30,
            'orderBy' => 'starttime',
            'singleEvents' => true
        ];
        $results = $service->events->listEvents($calendarId, $opt);

        return $results->getItems();
    }

    /**
     * Add new event
     * @param Events $events
     * @throws \Google\Exception
     */
    public function addEvent(Tutorshipsessions $session): String
    {
        $client = $this->getClientForRequest();
        $service = new \Google_Service_Calendar($client);

        $event = new \Google_Service_Calendar_Event();
        $event->setSummary($session->getBody());
        $event->setLocation('Online');
        $start = new \Google_Service_Calendar_EventDateTime();
        $start->setDateTime($session->getDate()->format('c'));
        $start->setTimeZone('Africa/Addis_Ababa');
        $event->setStart($start);
        $event->setId("session" . $session->getIdsession());
        $duration = new \DateInterval('PT2H');
        $theory =  date_add($session->getDate(), $duration);
        $end = new \Google_Service_Calendar_EventDateTime();
        $end->setDateTime($theory->format('c'));    
        $event->setEnd($end);
        $attendee1 = new Google_Service_Calendar_EventAttendee();
        $attendee1->setEmail($session->getIdStudent()->getEmail());
        $attendee2 = new Google_Service_Calendar_EventAttendee();
        $attendee2->setEmail($session->getIdTutor()->getEmail());
        $attendee = [$attendee1, $attendee2];
        $event->setAttendees($attendee);
        $reminder = new \Google_Service_Calendar_EventReminders();
        $reminder->setUseDefault(true);
        $event->setReminders($reminder);
        $conferenceKey = new \Google_Service_Calendar_ConferenceSolutionKey();
        $conferenceKey->setType("hangoutsMeet");
        $createConfReq = new \Google_Service_Calendar_CreateConferenceRequest();
        $createConfReq->setRequestId("3whatisup3");
        $createConfReq->setConferenceSolutionKey($conferenceKey);
        $conferenceData = new \Google_Service_Calendar_ConferenceData();
        $conferenceData->setCreateRequest($createConfReq);
        $event->setConferenceData($conferenceData);

        try {
            // $event = $service->events->setConferenceData($conferenceData)->insert('primary', $event);
            $event = $service->events->insert('primary', $event, ["conferenceDataVersion" => ["type" => 1]]);
            return $event->getHangoutLink();
        } catch (\Exception $e) {
            dd($e);
        }
        return "url";
    }

    /**
     * Remove event
     * @param string $id
     * @return bool
     * @throws \Google\Exception
     */
    public function removeEvent(string $id): bool
    {
        $client = $this->getClientForRequest();
        $service = new \Google_Service_Calendar($client);

        if ($service->events->delete('primary', $id)) {
            return true;
        }

        return false;
    }
}
