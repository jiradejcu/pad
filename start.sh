docker network create prs || true

docker rm -f mysql
docker run -d \
    --name mysql \
    -v `pwd`/data:/var/lib/mysql \
    -p 3306:3306 \
    --network prs \
    -e MYSQL_ALLOW_EMPTY_PASSWORD=1 \
    mysql:8.0

docker rm -f phpmyadmin
docker run -d \
    --name phpmyadmin \
    --link mysql:db \
    --network prs \
    -p 8888:80 \
    phpmyadmin/phpmyadmin

docker build -t prs ./docker
docker rm -f prs
docker run -it -d \
    --name=prs \
    -e container=docker \
    -v `pwd`:/var/www/html \
    -v /sys/fs/cgroup:/sys/fs/cgroup:ro \
    -p 8899:80 \
    --network prs \
    --cap-add=SYS_ADMIN \
    --stop-signal=SIGRTMIN+3 \
    --security-opt=seccomp:unconfined \
    prs
