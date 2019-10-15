rest_api_movie
==============

A Symfony project to generate Json on endpoints from database. 

For this project purpose i create a table movie in the database with following records : Id, name, description and year.

On first endpoint /api/ app will return json with all information from database.
For example : 

`[{"id":1,"name":"Skazani na Shawshank","description":"The Shawshank Redemption","year":1994},{"id":3,"name":"Ojciec Chrzestny","description":"The Godfather","year":1972},{"id":5,"name":"Mroczny Rycerz","description":"The Dark Knight","year":2008},{"id":7,"name":"Pulp Fiction","description":"Pulp Fiction","year":1994},{"id":9,"name":"Joker","description":"Joker","year":2019}]`

On the second endpoint /api/{id} app will return json with information about one record.

Example :

`{"id":3,"name":"Ojciec Chrzestny","description":"The Godfather","year":1972}`

When record doesn't exist app will return proper information. 

`{"Message":"Movie on this id not found"}
`

For this project i use PHP, Symfony version 3.4 and Serializer component in version 3.4