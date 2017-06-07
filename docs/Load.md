# Load

Services in just-core are accessed via HTTP or CLI exposed directory that can be configured to expose a specific or global set of services.

These directories contain 2 key files 

```
	index.php
	harness.php
```

### index.php 

Should define how to handle the request transport. The transport mechanism should be completely agnostic from the business logic 
and iindex.php is used to define some of this basic context.

#### _UI/MAIN_UI

In the case of `/_UI/MAIN_UI/index.php` a preliminary test is performed to see if the top level index is being requested, in this case 
a splash page is loaded and processing is exited. 

If any other URI fragment is in the request `harness.php` will be loaded to start the application bootstrap. After the bootstrap process 
is complete `index.php` will load a user management service, define the application route parsing as well as any sub-routines required 
to render the page

#### APIS/JSON-RPC

In the case of `/APIS/JSON-RPC/index.php` we load the application bootstrap immediately followed by parsing of the transport layer
and finally making the service request.

### harness.php 

The bootstrap process is actually separated into 2 layers, the first in `/APIS/[api_path]/harness.php` which is service API specific, 
the second is `init.php` in the project root directory. 

The harness usually follows a basic structure 

- check to ensure the page is not loaded directly, 
- process any environment flags (dev/uat/prod etc.)
- set the `$APPLICATION_ROOT` directory (project root)
- check to see if a site update notification should be displayed)
- load init.php from the project root directory 
- start the "session"/user identification mechanism
- load the authentication harness 
  - and register the authentication service(s)
- load IP white/black list *APIS only*
- execute user authentication checks 
- load the "view" access filters
- verify HTTPS 
- redirect to login if the user authentication fails *_UI only*
- throw error if any authentication or authorization check fails *APIS only*
- initialize authorization (Access Control List) 
- static asset load & cache management *_UI only*




