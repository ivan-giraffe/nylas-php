<?php namespace Nylas\Utilities;

use Nylas\Request\Sync;
use Nylas\Request\Async;
use Nylas\Accounts\Account;
use Nylas\Utilities\Validate as V;

/**
 * ----------------------------------------------------------------------------------
 * Nylas Utils Options
 * ----------------------------------------------------------------------------------
 *
 * @author lanlin
 * @change 2018/12/18
 */
class Options
{

    // ------------------------------------------------------------------------------

    /**
     * @var bool
     */
    private $debug = false;

    /**
     * @var bool
     */
    private $offDecodeError = false;

    /**
     * @var string
     */
    private $logFile;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $accountId;

    /**
     * @var array
     */
    private $accountInfo;

    // ------------------------------------------------------------------------------

    /**
     * Options constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $rules = V::keySet(
            V::key('debug', V::boolType(), false),
            V::key('log_file', V::stringType()->notEmpty(), false),
            V::key('account_id', V::stringType()->notEmpty(), false),
            V::key('access_token', V::stringType()->notEmpty(), false),
            V::key('off_decode_error', V::boolType(), false),

            V::key('client_id', V::stringType()->notEmpty()),
            V::key('client_secret', V::stringType()->notEmpty())
        );

        V::doValidate($rules, $options);

        // required
        $this->setClientApps($options['client_id'], $options['client_secret']);

        // optional
        $this->setDebug($options['debug'] ?? false);
        $this->setLogFile($options['log_file'] ?? null);
        $this->setAccountId($options['account_id'] ?? '');
        $this->setAccessToken($options['access_token'] ?? '');
        $this->setOffDecodeError($options['off_decode_error'] ?? false);
    }

    // ------------------------------------------------------------------------------

    /**
     * @param string $token
     */
    public function setAccessToken(string $token)
    {
        $this->accessToken = $token;

        if (!$token) { return; }

        // cache account info
        $this->accountInfo = (new Account($this))->getAccount();
    }

    // ------------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken ?? null;
    }

    // ------------------------------------------------------------------------------

    /**
     * @param string $id
     */
    public function setAccountId(string $id)
    {
        $this->accountId = $id;
    }

    // ------------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId ?? null;
    }

    // ------------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getServer()
    {
        return API::LIST['server'];
    }

    // ------------------------------------------------------------------------------

    /**
     * @param bool $debug
     */
    public function setDebug(bool $debug)
    {
        $this->debug = $debug;
    }

    // ------------------------------------------------------------------------------

    /**
     * @param string $logFile
     */
    public function setLogFile(string $logFile)
    {
        $this->logFile = $logFile;
    }

    // ------------------------------------------------------------------------------

    /**
     * @param bool $off
     */
    public function setOffDecodeError(bool $off)
    {
        $this->offDecodeError = $off;
    }

    // ------------------------------------------------------------------------------

    /**
     * @param string $clientId
     * @param string $clientSecret
     */
    public function setClientApps(string $clientId, string $clientSecret)
    {
        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
    }

    // ------------------------------------------------------------------------------

    /**
     * @return array
     */
    public function getClientApps()
    {
        return
        [
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
    }

    // ------------------------------------------------------------------------------

    /**
     * @return array
     */
    public function getAllOptions()
    {
        return
        [
            'debug'            => $this->debug,
            'log_file'         => $this->logFile,
            'server'           => API::LIST['server'],
            'client_id'        => $this->clientId,
            'client_secret'    => $this->clientSecret,
            'account_id'       => $this->accountId,
            'access_token'     => $this->accessToken,
            'off_decode_error' => $this->offDecodeError,
        ];
    }

    // ------------------------------------------------------------------------------

    /**
     * get sync request instance
     */
    public function getSync()
    {
        $debug  = $this->debug;
        $server = $this->getServer();

        // when set log file
        if ($this->debug && !empty($this->logFile))
        {
            $debug = fopen($this->logFile, 'a');
        }

        return new Sync($server, $debug, $this->offDecodeError);
    }

    // ------------------------------------------------------------------------------

    /**
     * get async request instance
     */
    public function getAsync()
    {
        $debug  = $this->debug;
        $server = $this->getServer();

        // when set log file
        if ($this->debug && !empty($this->logFile))
        {
            $debug = fopen($this->logFile, 'a');
        }

        return new Async($server, $debug, $this->offDecodeError);
    }

    // ------------------------------------------------------------------------------

    /**
     * get account infos
     *
     * @return array
     */
    public function getAccount()
    {
        $temp =
        [
            'id'                => '',
            'account_id'        => '',
            'email_address'     => '',
            'name'              => '',
            'object'            => '',
            'provider'          => '',
            'linked_at'         => null,
            'sync_state'        => '',
            'organization_unit' => '',
        ];

        return array_merge($temp, $this->accountInfo);
    }

    // ------------------------------------------------------------------------------

}
