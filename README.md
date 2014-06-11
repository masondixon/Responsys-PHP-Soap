interact_sdk
============

php soap client for responsys api

Details:
Uses php -v 5.3.28 ( cli )<br>
Uses built in php soap client that creates client at runtime ( this means that the WSDL and Endpoint must be up @ Responsys )<br>
Built against latest Responsys API version 6.20 ( as of 6/11/2014 )
<br><br>

Getting Started:<br>
1. Obtain SDK and API documentation.<br>
2. Confirm that you have a valid Responsys API user <br>
3. Update the config.default.inc with your login information and WSDL and endpoint locations. <br>
4. Rename config.default.inc to config.inc <br>
5. Start with either the unit tests ( the tests were written for PHPUnit ), or the basic samples to get an understanding of how everything works. <br>

Notes:<br>
Almost all of these calls depend on objects existing on the Responsys side.  <br>
Most of this work must be done within the UI unfortunately. <br>
