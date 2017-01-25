# Project Vision 

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


