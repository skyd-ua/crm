FROM node:lts-bullseye

ARG crm_base_dir
ENV CRM_WEB_DIR="${crm_base_dir}/web"
ENV CRM_WEB_PORT=3456

RUN apt update -qq \
 && apt install -qq -y \
    supervisor

RUN { \
    echo "[supervisord]"; \
    echo "nodaemon = true"; \
    echo "user = root"; \
} | tee /etc/supervisor/conf.d/docker.conf

WORKDIR "${CRM_WEB_DIR}"

CMD [ "/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf" ]

EXPOSE "${CRM_WEB_PORT}"
