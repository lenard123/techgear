FROM gitpod/workspace-mysql

RUN mysql -e "CREATE DATABASE online_store;" 