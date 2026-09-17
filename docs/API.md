# Backend endpoints

All routes are defined in `routes/web.php`. Paths are relative to the app root, for example `http://<host>/BookBasementApp/public/`.

## Products

| Method | Path | Handler |
|---|---|---|
| GET | `products` | inventory page |
| POST | `products/add` | create a book |
| POST | `products/genreAdd` | create a genre |
| GET | `products/list` | DataTables listing |
| GET | `products/find/{id}` | one book |
| POST | `products/update` | update a book |
| POST | `products/delete` | delete a book |
| POST | `products/findFiltered` | filtered search used by the app |

## Genres

| Method | Path | Handler |
|---|---|---|
| GET | `genres/data` | all genres |

## Appointments

| Method | Path | Handler |
|---|---|---|
| GET | `appointments` | appointments page |
| GET | `appointments/find/{id}` | one appointment |
| POST | `appointments/cancel` | cancel |
| POST | `appointments/done` | mark done |
| GET | `appointments/data/{user_id}` | a user's appointments |
| POST | `appointments/donate/donateStore` | book a donation |
| POST | `appointments/buy/buyStore` | book a purchase |
| POST | `appointments/sell/sell` | book a sale |

## Cart

| Method | Path | Handler |
|---|---|---|
| POST | `cartList/store` | add to cart |
| GET | `cartList/data/{id}` | a user's cart |
| POST | `cartList/remove` | remove from cart |

## Favorites

| Method | Path | Handler |
|---|---|---|
| POST | `favorites/store` | add favorite |
| GET | `favorites/data/{user_id}` | a user's favorites |
| POST | `favorites/remove` | remove favorite |

## Recommendations

| Method | Path | Handler |
|---|---|---|
| GET | `recommendation/data` | recommended books |
| GET | `recommendation/dataGenre/{id}` | recommendations for a genre |

## Users

| Method | Path | Handler |
|---|---|---|
| POST | `user/register` | register an app user |
| POST | `user/checkUser` | look up a user |

Web login, registration, and password reset come from `Auth::routes()`, and `home` is the post-login landing page.

## Called by the app but not present here

The Android client also calls these paths. They are not defined in this backend version, so they return 404 until added:

- `POST appointments/sell/sellStore` (this backend exposes `appointments/sell/sell`)
- `GET user/data/{user_id}`
- `GET recycle/data`
- `POST appointments/recycle/recycleStore`
