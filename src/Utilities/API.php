<?php namespace Nylas\Utilities;

/**
 * ----------------------------------------------------------------------------------
 * Nylas RESTFul API List
 * ----------------------------------------------------------------------------------
 *
 * @link https://changelog.nylas.com/
 * @link https://docs.nylas.com/reference#api-changelog
 * @version 2.0 (2018-09-01)
 *
 * @author lanlin
 * @change 2019/05/28
 */
class API
{

    // ------------------------------------------------------------------------------

    /**
     * nylas api list array
     */
    const LIST =
    [
        'server' => 'https://api.nylas.com',

        // Authentication
        'oAuthToken'        => '/oauth/token',
        'oAuthRevoke'       => '/oauth/revoke',
        'oAuthAuthorize'    => '/oauth/authorize',
        'connectToken'      => '/connect/token',
        'connectAuthorize'  => '/connect/authorize',

        // Accounts
        'account'            => '/account',
        'ipAddresses'        => '/a/%s/accounts/%s/ip_addresses',
        'listAnAccount'      => '/a/%s/accounts/%s',
        'listAllAccounts'    => '/a/%s/accounts',
        'cancelAnAccount'    => '/a/%s/accounts/%s/downgrade',
        'revokeAllTokens'    => '/a/%s/accounts/%s/revoke-all',
        'reactiveAnAccount'  => '/a/%s/accounts/%s/upgrade',

        // Threads
        'threads'    => '/threads',
        'oneThread'  => '/threads/%s',

        // Messages
        'messages'    => '/messages',
        'oneMessage'  => '/messages/%s',

        // Folders
        'folders'     => '/folders',
        'oneFolder'   => '/folders/%s',

        // Labels
        'labels'      => '/labels',
        'oneLabel'    => '/labels/%s',

        // Drafts
        'drafts'      => '/drafts',
        'oneDraft'    => '/drafts/%s',

        // Sending
        'sending'     => '/send',

        // Files
        'files'         => '/files',
        'oneFile'       => '/files/%s',
        'downloadFile'  => '/files/%s/download',

        // Calendars
        'calendars'     => '/calendars',
        'oneCalendar'   => '/calendars/%s',

        // Events
        'events'       => '/events',
        'oneEvent'     => '/events/%s',
        'RSVPing'      => '/send-rsvp',

        // Contacts
        'contacts'       => '/contacts',
        'oneContact'     => '/contacts/%s',
        'contactPic'     => '/contacts/%s/picture',
        'contactsGroups' => '/contacts/groups',

        // Search
        'searchThreads'  => '/threads/search',
        'searchMessages' => '/messages/search',

        // Webhooks
        'webhooks'    => '/webhooks',
        'oneWebhook'  => '/webhooks/%s',

        // Deltas
        'delta'              => '/delta',
        'deltaLongpoll'      => '/delta/longpoll',
        'deltaStreaming'     => '/delta/streaming',
        'deltaLatestCursor'  => '/delta/latest_cursor',
    ];


    // ------------------------------------------------------------------------------

}
