# ENV FILE FOR THE GITHUB ACTION RUNNING MYSQL
APP_NAME=Laravel
APP_ENV=testing
APP_KEY=base64:NTrXToqFZJlv48dgPc+kNpc3SBt333TfDnF1mDShsBg=
APP_DEBUG=true
APP_URL=https://journalos.test

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=bivouac
DB_USERNAME=bivouac
DB_PASSWORD=secret

BROADCAST_DRIVER=log

DEBUGBAR_ENABLED=false
CACHE_DRIVER=array
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
MAIL_MAILER=array

SCOUT_DRIVER=collection

LEMON_SQUEEZY_ACTIVATE=true
LEMON_SQUEEZY_URL=https://bivouac.lemonsqueezy.com/
