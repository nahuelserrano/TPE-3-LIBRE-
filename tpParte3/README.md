# API de oedenes de compra - RESTful

## TPE WEB 2 (3ra entrega)

### nahuel serrano(<roark.nahuelthiago@gmail.com>)



la api se basara en la posibilidad de poder cargar ordenes de compra con sus respectivos datos



## Entidad

### orden de compra

esta tabla cuenta con los atributos: "id", "nombre", "apellido", "nombre_producto","id de la categoria"


## Endpoints

### GET = (http://localhost/web2/tpParte3/api/ordendecompra)

- **Funcionalidad**: Lista todas las ordenes de compra

- **en caso de error**: Responde con error 404 si se no se encuentra dicha busqueda 



### GET/id = (http://localhost/web2/tpParte3/api/ordendecompra/id)

- **Funcionalidad**: Muestra una orden de compra especificada por su id.
- **Excepciones**: Responde con error 404 si la orden de compra ingresada no existe.


### DELETE/id = (http://localhost/web2/tpParte3/api/ordendecompra/id)

- **Funcionalidad**: Elimina una orden de compra especificada por su id.
- **Excepciones**:
  - Responde con error 404 si la orden de compra  ingresada no existe.
       
 

### POST = (http://localhost/web2/tpParte3/api/ordendecompra/id)

- **Funcionalidad**: Crea una orden de compra nueva que le pasamos como JSON en el body.
- **Excepciones**:
  - Responde con error 400 si falta ingresar algun dato de la orden de compra.
    {
  
    "nombre": "nahuel thiago", necesario
    "apellido": "sdfs",  necesario
    "nombre_producto": "mani",necesario
    "TipoProducto": se coloca el nombre de la categoria y el controller verifica que exista,necesario
    "descripcion": "ds",necesario
    "imagen": "imagenes/67eabb4ecd932_Imagen de WhatsApp 2025-03-05 a las 19.20.13_14f5b4e1.jpg",necesario
    "fecha": "2025-04-23" no necesario
  }

### filtrar = (http://localhost/web2/tpParte3/api/ordendecompra?nombre=... o ?apellido= ..)

- **Funcionalidad**: busca una orden la cual tenga un nombre y/o un apellido en especial
- **Excepciones**:
  -si no lo encuentra retorna un arreglo vacio.
   

### put/id = (http://localhost/web2/tpParte3/api/ordendecompra/id)

- **Funcionalidad**: Modifica una orden de compra especificada por su id y le pasamos los nuevos datos como JSON en el body.\
- **Excepciones**:
  - Responde con error 400 si falta ingresar algun dato de la ordendecompra.
     {
  
    "nombre": "nahuel thiago", 
    "apellido": "sdfs",  
    "nombre_producto": "mani",
    "TipoProducto": se coloca el nombre una categoria y el controlle se encarda de controlar que exista 
    "descripcion": "ds",
    "imagen": "imagenes/67eabb4ecd932_Imagen de WhatsApp 2025-03-05 a las 19.20.13_14f5b4e1.jpg",
    "fecha": "2025-04-23" no 
  }

  debes completar almenos un campo para poder ejecutarla, la funcion update da la posibilidad de editar un solo elemento de la tabla

### paginar = (http://localhost/web2/tpParte3/api/ordendecompra?page=n&limit=n)



page (opcional):
Especifica el número de página que se desea recuperar.
Debe ser un número entero positivo.
Si no se proporciona, se asume la primera página (página 1).
Si se proporciona un valor de 0, la api devolvera un error.
limit (opcional):
Especifica el número máximo de registros que se deben devolver por página.
Debe ser un número entero positivo.
Si no se proporciona, la API puede aplicar un límite predeterminado.
Si se proporciona un valor de 0, la api devolvera un array vacio.
Funcionamiento:

La API utiliza los parámetros page y limit para calcular el desplazamiento (OFFSET) y el límite (LIMIT) en la consulta a la base de datos.
Solo se devuelven los registros correspondientes a la página solicitada.
Si no hay registros en la página solicitada, la API devuelve un arreglo vacío.
Ejemplo:

Para obtener la página 3 con 10 registros por página, se utilizaría la siguiente URL:

/api/ordendecompra?page=3&limit=10
Notas:

Es importante utilizar números enteros positivos para los parámetros page y limit.
La API maneja los casos en que no se proporcionan los parámetros de paginación o cuando se proporcionan valores inválidos.
Cuando el valor del limit es 0, la api siempre va a devolver un arreglo vacio.
Cuando el valor del page es 0, la api devolvera un error.


## Breve explicación del sitio

Esta pagina web esta diseñada para gestionar las órdenes de compra de manera sencilla. Los usuarios pueden ingresar detalles clave, como el nombre y apellido del comprador, junto con la información del producto (nombre y tipo). Esto ayuda a organizar las compras y mantener un registro claro de los productos vendidos.
Con funcionalidades adicionales, que permiten una gestión más flexible de las órdenes de compra. Los usuarios pueden modificar o eliminar registros existentes, así como realizar búsquedas específicas por ID para acceder rápidamente a la información. Esto hace que la administración de órdenes sea más eficiente.


## loguin para determinadas funciones- tuve un error que no logre resolver.

usuario: roark.nahuelthiago@gmail.com
password: admin

el login se ejecuta correctamante y devuelve el token como deberia al presionar send con los campos del basic completos.

problema: cuando coloco el token en el basic, entiendo que el token termina en la funcion get token() dando error en el segundo if(), retornando error en los datos ingresados. no logre poder encontrar la manera de que ese token llegue al validate.

los metodos post y put se encuentrar bloqueados por no estar logueado, de querer testear su uso, se debera quitar el if(res->user) de sus funciones en el controlador y podran ejecutarse correctamente