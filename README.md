# Introduction

Our customer now can call the endpoint bellow to retrieve random review for a given hotel.
To use it in his landing page.

## Installation

```shell
git clone https://github.com/chadidi/hotel_review_test.git
cd hotel_review_test
cp .env.example .env
# setup you database connection
composer install
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load // seed data

//error
GET: http://hotels.me/1/today/review
{
    "error": {
        "message": "The hotel id was not found."
    }
}
// success
GET: http://hotels.me/5/today/review
{
    "today_review": {
        "id": 29,
        "title": "Autem quisquam voluptates quia autem rerum et cumque.",
        "body": "Rem qui autem perspiciatis aut. Voluptatem facere et aut repudiandae quia. Laudantium reprehenderit placeat qui voluptates. Et fugit aut porro. Et ipsam excepturi porro sint dolore aut suscipit debitis. Molestiae adipisci saepe voluptatibus repellendus nemo deleniti voluptatem. Non exercitationem quo laborum aut dolores deleniti reprehenderit. Dolorum adipisci ducimus quia odio ratione architecto occaecati.",
        "rating": 3.24,
        "created_at": {
            "date": "2018-09-01 08:41:05.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        }
    }
}
```
