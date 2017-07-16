FROM postgres:9.6

RUN localedef -i ru_UA -c -f UTF-8 -A /usr/share/locale/locale.alias ru_UA.UTF-8
ENV LANG ru_UA.utf8

# Install selected extensions and other stuff
#RUN echo "Installing ru_UA.UTF-8 locale" \
#RUN locale-gen ru_UA.UTF-8&&locale-gen ru_RU.UTF-8&&locale-gen uk_UA.UTF-8&&locale-gen en_US.UTF-8
#RUN dpkg-reconfigure locales
#RUN export LC_ALL="ru_UA.UTF-8"&&export LANGUAGE="ru_UA.UTF-8"&&echo 'LANGUAGE="ru_UA.UTF-8"' >> /etc/default/locale&&echo 'LC_ALL="ru_UA.UTF-8"' >> /etc/default/locale
#RUN export LC_CTYPE="ru_UA.UTF-8"&&export LANG="ru_UA.UTF-8"

#ENV LANG ru_UA.UTF-8
#ENV LC_ALL ru_UA.UTF-8
#ENV LANGUAGE ru_UA:ru
#ENV LANG C.UTF-8
#ENV LANG C.UTF-8

#RUN update-locale LANG="ru_UA.UTF-8"
#RUN echo locale -a
#    service postgresql restart

ADD ./postgresql/init-db.sql /docker-entrypoint-initdb.d/

#USER postgres
#
#RUN psql  -c "CREATE ROLE web LOGIN ENCRYPTED PASSWORD 'md5b2f3841c032b78c3686b9de01c6a6ed7' VALID UNTIL 'infinity';" \
#    psql  -c "CREATE DATABASE web WITH OWNER = web ENCODING = 'UTF8' TEMPLATE=template0 TABLESPACE = pg_default LC_COLLATE = 'ru_UA.UTF-8' LC_CTYPE = 'ru_UA.UTF-8' CONNECTION LIMIT = -1;" \



#echo "listen_addresses = '*'" >> /var/lib/postgresql/data/postgresql.conf \
#    echo "logging_collector = on" >> /var/lib/postgresql/data/postgresql.conf \
#    echo "host all all all md5" >> /var/lib/postgresql/data/pg_hba.conf \