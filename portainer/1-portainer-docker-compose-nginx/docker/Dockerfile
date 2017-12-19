FROM nginx:alpine
# Remove existing configuration
RUN rm -v /etc/nginx/conf.d/*
# Insert our portainer conf
COPY portainer.conf /etc/nginx/conf.d/portainer.conf