# loginPHP-MySQL

despues de agregar un usuario es necesario modificarlo para convertirlo en administrador
```sql
update usuarios set tipo=1 where id="id"
```