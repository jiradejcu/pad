docker network create prs || true

docker rm -f prs-mysql
docker run -d \
    --name prs-mysql \
    -v `pwd`/data:/var/lib/mysql \
    -p 3307:3306 \
    --network prs \
    -e MYSQL_ALLOW_EMPTY_PASSWORD=1 \
    --platform linux/x86_64 \
    mysql:5.7

docker build -t prs ./docker
docker rm -f prs
docker run -it -d \
    --name=prs \
    -v `pwd`:/var/www/html \
    --network prs \
    -p 8899:80 \
    prs
