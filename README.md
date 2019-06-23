transactionFinder
============

This Repo is Rest Api For payment Transactions you can search by 
  * amount Max and Min 
  * provider
  * statusCode 
  * currency 
  
  
## Installation   

clone this application from git@github.com:m-abdou/transactionFinder.git

cd to transactionFinder directory 

 - run composer install 
 - run php bin/console server:run
 - open browser and put this link http://127.0.0.1:8001/api/payment/transaction
    you will get all 
     
 ** test Cases run those commands 
php bin/phpunit
 
 
 or can use docker 
 
 cd to transactionFinder/docker 
 
 make build 
 make install
 make up 
 
 http://127.0.0.1:7070/api/payment/transaction
 
 ## Documentation
 
 we provide one end point get request with url /api/hotels
 
 - /api/payment/transaction -> get all transactions 
 - /api/payment/transaction?provider=example get all transactions with provider 
 - /api/payment/transaction?amountMin=5&amountMax=10 get transactions in this range
 - /api/payment/transaction?currency=AUD get transactions by currency 
 - /api/payment/transaction?statusCode=AUD get transactions by statusCode 

we can combine search criteria with multi factor 

 - /api/payment/transaction?amountMin=5&amountMax=10&provider=name


## Brif 

This application based on php 7.1 and symfony 4.3 

created by design patterns middleware concept and factory with solid principle and service oriented

 - manger responsible for execute middlewares 
 - Validator layer one of middlewares responsible for checking validation and error handling 
 - loader layer two of middlewares responsible for fetch all transactions data 
 - Operator third middlerwares responsible for run search criteria and get result 
 
 
 we can scala by adding new payment transaction by   
 
 - add new model with specific schema in model directory 
 - add new service to serve new payment 
 - allow factory and loader to access new payment
 
 
 performance 
 
 we can enhance performance by using caching layer in loader service and save it in redis and create crone job to check new transactions
 
 
 code quality 
 
 write more test cases to make sure every single unit tested and have a good coverage 
