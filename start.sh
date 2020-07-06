docker network create prs || true

docker rm -f mariadb
docker run -d \
    --name mariadb \
    -v `pwd`/data:/var/lib/mysql \
    -p 3306:3306 \
    --network prs \
    -e MARIADB_ALLOW_EMPTY_PASSWORD=1 \
    mariadb/server:10.3

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
