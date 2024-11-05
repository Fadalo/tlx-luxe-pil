#!/bin/sh
# wait-for-db.sh

set -e

host="$1"
shift
until mysql -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" -e 'select 1' &> /dev/null; do
  >&2 echo "Database is unavailable - sleeping"
  sleep 1
done

>&2 echo "Database is up - executing command"
exec "$@"
