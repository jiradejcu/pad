FROM centos:7
ENV container docker
RUN (cd /lib/systemd/system/sysinit.target.wants/; for i in *; do [ $i == \
systemd-tmpfiles-setup.service ] || rm -f $i; done); \
rm -f /lib/systemd/system/multi-user.target.wants/*;\
rm -f /etc/systemd/system/*.wants/*;\
rm -f /lib/systemd/system/local-fs.target.wants/*; \
rm -f /lib/systemd/system/sockets.target.wants/*udev*; \
rm -f /lib/systemd/system/sockets.target.wants/*initctl*; \
rm -f /lib/systemd/system/basic.target.wants/*;\
rm -f /lib/systemd/system/anaconda.target.wants/*;
VOLUME [ "/sys/fs/cgroup" ]
CMD ["/usr/sbin/init"]

RUN yum install -y \
    wget \
    sudo \
    nano \
    git

RUN yum install -y \
    httpd \
    php \
    php-mysql \
    php-fpm

RUN yum remove -y \
    php-cli \
    mod_php \
    php-common

RUN rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
RUN rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
RUN yum update -y && yum install -y \
    php70w \
    php70w-fpm \
    php70w-mbstring \
    php70w-mcrypt \
    php70w-mysql \
    php70w-xml

RUN yum clean all
RUN systemctl enable httpd.service

COPY install.sh /tmp
WORKDIR /tmp
RUN chmod +x install.sh && ./install.sh
WORKDIR /
