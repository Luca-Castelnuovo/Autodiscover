<?php

namespace App\Controllers;

use CQ\Response\Xml;

class AutoMXController
{
    /**
     * List entries.
     *
     * @return Xml
     */
    public function index()
    {
        $data = file_get_contents("php://input");
        preg_match("/\<EMailAddress\>(.*?)\<\/EMailAddress\>/", $data, $matches);

        return new Xml(<<<XML
        <Autodiscover xmlns="http://schemas.microsoft.com/exchange/autodiscover/responseschema/2006">
            <Response xmlns="http://schemas.microsoft.com/exchange/autodiscover/outlook/responseschema/2006a">
                <Account>
                    <AccountType>email</AccountType>
                    <Action>settings</Action>
                    <Protocol>
                        <Type>SMTP</Type>
                        <Server>mail.castelnuovo.xyz</Server>
                        <Port>587</Port>
                        <DomainRequired>off</DomainRequired>
                        <LoginName>{$matches[1]}</LoginName>
                        <SPA>off</SPA>
                        <Encryption>TLS</Encryption>
                        <AuthRequired>on</AuthRequired>
                        <TTL>6</TTL>
                    </Protocol>
                    <Protocol>
                        <Type>IMAP</Type>
                        <Server>mail.castelnuovo.xyz</Server>
                        <Port>143</Port>
                        <DomainRequired>off</DomainRequired>
                        <LoginName>{$matches[1]}</LoginName>
                        <SPA>off</SPA>
                        <Encryption>TLS</Encryption>
                        <AuthRequired>on</AuthRequired>
                        <TTL>6</TTL>
                    </Protocol>
                    <!-- <Protocol>
                        <Type>POP3</Type>
                        <Server>mail.castelnuovo.xyz</Server>
                        <Port>110</Port>
                        <DomainRequired>off</DomainRequired>
                        <LoginName>{$matches[1]}</LoginName>
                        <SPA>off</SPA>
                        <Encryption>TLS</Encryption>
                        <AuthRequired>on</AuthRequired>
                    </Protocol> -->
                </Account>
            </Response>
        </Autodiscover>
XML, 200);
    }
}
