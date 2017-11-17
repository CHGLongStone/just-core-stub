# Project Vision 

The whole point of technology should be to make life easier. It should be designed around the business processes and procedures 
rather that having people do contortionist acts to work with poorly designed software. The same should hold true for the people 
who are building the software. 

The project was started to collect the efforts of a single developer who had the good fortune of working in large distributed 
LAMP environments since the early days of PHP 4 

Given that just-core is designed to support Enterprise level applications it implements a SOA (Service Oriented Architecture) 
with core services conforming to the format of the ESB (Enterprise Service Bus). 

### just-core service buses

 * Authentication/Authorization 
 * Cache (opcode and data) 
 * Data layer (connection management) 
 * DAO (basic Data Access Objects) 
 * Exception
 * Localization 
 * Load (bootstrap and autoload )
 * Templater 
 * Transport layer 

Services are called by name-space via the transport layer in their native transport envelope (JSON, XML, URI_ENCODED), the service manager then calls 
the service in the format `[serviceName][methodName]` with the arguments being supplied as the transport envelope dictates. 

When the response to the service call has been processed the service will respond in the format dictated for the API 

 * AjAX->JSON-RPC
 * ReST->JSON
 * ReST->URI_ENCODED
 * ReST->SOAP
 * ...

Constraints

* Services must conform to one of the name spaces specified in [supported composer autoload formats](https://getcomposer.org/doc/04-schema.md#autoload).
* Services can be called singly, chained or on demand within the application architecture.

Services can be configured with their own auto loaded values if they follow the format shown [here](https://github.com/CHGLongStone/just-core-stub/wiki#application-configuration)



`$GLOBALS["CONFIG_MANAGER"]->getSetting('CACHE','JCORE_SYSTEM_CACHE');`


, [Services](../../just-core/Services)


