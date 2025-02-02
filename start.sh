docker network create prs || true

docker rm -f mysql
docker run -d \
    --name mysql \
    -v `pwd`/data:/var/lib/mysql \
    -p 3307:3306 \
    --network prs \
    -e MYSQL_ALLOW_EMPTY_PASSWORD=1 \
    mysql:8.0

docker build --no-cache -t prs ./docker
docker rm -f prs
docker run -it -d \
    --name=prs \
    -v `pwd`:/var/www/html \
    --network prs \
    -p 8899:80 \
    prs
