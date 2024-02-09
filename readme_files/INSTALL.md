[< Back to Table of Contents](../README.md)

___

### Environment Setup
The project is built based on the `docker-compose.yml` configuration file.
It's advisable to check the parameters to avoid conflicts with your system before running the project:

_docker-compose.yml:_
   ```yml
   mysql:
     
     ...
     
     ports:
         # Here the database port is exposed externally.
         # "3396" can be replaced with any available port,
         # if this one is occupied on your machine
       - 3396:3306
 
   ```

### Running the Project
The project can be easily built and launched with the command
   ```bash
   make init
   ```
This command will deploy the containers, create the database schema, and download project dependencies

To perform the initial car ads import required for task verification, please run the command:
   ```bash
   make import-cars
   ```
Now you can proceed to [the next section](./TEST.md) 

### Shutting down the Project
The project can be stopped with all the containers through:
   ```bash
   make down
   ```
___

[< Back to Table of Contents](../README.md)
