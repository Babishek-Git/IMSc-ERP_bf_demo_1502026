<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CustomAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        // Implement your SSO authentication logic here
        // Example: Check if the user is authenticated via SSO
        
       /* $SsoLoginUrl = env('SSO_LOGIN_URL');
        $SsoSoapWsdlUrl = env('SSO_SOAP_WSDL_URL');
        $SsoSoapVersion = env('SSO_SOAP_VERSION');
        $WcmsAppServerIp = env('erp_APP_SERVER_IP');
        $WcmsAppServerIpWithPid = env('erp_APP_SERVER_IP_WITH_PID');
        $WcmsRootDirName = env('erp_ROOT_DIR_NAME');
        $params = array( 'trace' => 1,
            'exceptions' => true,
            'cache_wsdl' => WSDL_CACHE_NONE,
            //'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            //'uri' => $service_url,
            //'location' => $service_url,
            '_soap_version' => $SsoSoapVersion
        );
        $soapClient = new \SoapClient($SsoSoapWsdlUrl, $params);
        $ssoReturn = $soapClient->getLoginID(session('SsoSessionID'), $WcmsAppServerIp); 
        if (!auth()->check()) {

        }
        
        //$ssoReturn = 1;
        if ($ssoReturn == '-1') { 
            // Redirect to SSO login or initiate SSO authentication
            // Example: return redirect()->to('sso-login');
            $ClientIp = $request->ip();  
            $SsoSessionID  = "erp_".md5($ClientIp."_".date("YmdHis")); 
            session(['SsoSessionID' => $SsoSessionID]);
            $WcmsUrl    = $WcmsAppServerIpWithPid."/".$WcmsRootDirName."/sso";
            $SsoUrl     = $SsoLoginUrl."?MachineIP=".$WcmsAppServerIp."&SessionID=".$SsoSessionID."&url=".$WcmsUrl;
            return redirect()->to($SsoUrl);
        }*/

        return $next($request);
    }
}
