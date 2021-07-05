FROM nginx:1.17

##############################################################################
#### Packages installation
##############################################################################
RUN apt-get update
RUN yes | apt-get install nano iputils-ping
RUN yes | apt-get install python3 python3-pip
RUN pip3 install ngxtop