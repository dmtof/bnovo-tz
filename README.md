# Guest Microservice

## Описание

Микросервис для управления гостями (CRUD операции).

## Установка и запуск

### Требования

- Docker

### Запуск

```bash
docker compose up
```

## API

Получить список гостей

```
GET /api/guests
```

Создать гостя

```
POST /api/guests
{
    "first_name": "Test_name",
    "last_name": "Test_lastname",
    "email": "test@example.com",
    "phone": "+79991234567"
}
```

Получить гостя

```
GET /api/guests/{id}
```

Обновить гостя

```
PUT /api/guests/{id}
{
    "first_name": "Test_name",
    "last_name": "Test_lastname",
    "email": "test@example.com",
    "phone": "+79991234567"
}
```

Удалить гостя

```
DELETE /api/guests/{id}
```

## Заголовки ответов

Все ответы включают заголовки X-Debug-Time и X-Debug-Memory

