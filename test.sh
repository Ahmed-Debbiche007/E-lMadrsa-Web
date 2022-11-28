for file in ./migrations/*.docx
do
    if [ -f "${file}" ]; then
    echo $file
    echo "aa"
    break
    else
    echo "salam"
    break
    fi
done