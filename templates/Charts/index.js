const  graph = document.getElementById('graph').getContext('2d');
let myChart = new Chart("myChart", {
    type: "bar",
    data: {
        labels: [
            "formation 1",
            "formation 2",
            "formation 3",
            "formation 4"
        ],
        datasets: [
            {
                label: "Participation Par Formation",
                data: [3, 8, 15, 20]
            },
        ],
    },
});
