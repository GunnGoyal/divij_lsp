#!/bin/sh
set -e

# Railway injects PORT at runtime. Default to 8080 if not set (e.g. local testing).
PORT="${PORT:-8080}"

sed "s/__PORT__/${PORT}/" /etc/nginx/templates/default.conf.template > /etc/nginx/conf.d/default.conf

exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
