# Product Filter API

This project provides an API to filter products based on multiple parameters such as `subcategory_id`, `product_type`, `condition`, `seller_type`, `location`, `radius`, and `price`.

## API Endpoint

### POST `/api/filter`

This endpoint allows you to filter products based on the provided query parameters. You can either apply specific filters or retrieve all products if no filter is provided.

### Request Format

When sending the request, make sure to set the **Content-Type** header to `application/json`.

The data should be sent in **raw JSON** format.

### Example Request (Raw JSON Format)

```json
{
  "filter": true,
  "subcategory_id": 1,
  "product_type": "auction",
  "condition": "",
  "seller_type": "verified",
  "location": ["Islamabad", "Mardan"],
  "radius": 100,
  "price": 50000
}
