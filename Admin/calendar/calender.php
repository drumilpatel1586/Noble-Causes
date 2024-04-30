<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/requested_book.css">
    <title>Noble Causes - Calendar</title>
    <meta charset="utf-8" />
</head>
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
    header("Location: admin_login");
} ?>

<body>

    <div class="navbar">
        <?php include("../include/sidebar.php"); ?>
    </div>
    <div class="requested_book_content">
        <header>
            <div class="requested_book_content_title">
                <h1>Requested Book by User</h1>
                <ul class="navigation">
                    <li class="navigation-item">
                        <a href="../include/dashboard">Dashboard</a>
                    </li>
                    <li class="navigation-icon">
                        <i class="bx bx-chevron-right dropdown"> </i>
                    </li>
                    <li class="navigation-item">
                        <a href="../include/requested_book">Requested Book</a>
                    </li>
                    <li class="navigation-icon">
                        <i class="bx bx-chevron-right dropdown"> </i>
                    </li>
                </ul>
            </div>
        </header>
        <p>Google Calendar API Quickstart</p>

        <!--Add buttons to initiate auth sequence and sign out-->
        <button id="authorize_button" onclick="handleAuthClick()">Authorize</button>
        <button id="signout_button" onclick="handleSignoutClick()">Sign Out</button>

        <pre id="content" style="white-space: pre-wrap;"></pre>

    </div>

    <script type="text/javascript">
        /* exported gapiLoaded */
        /* exported gisLoaded */
        /* exported handleAuthClick */
        /* exported handleSignoutClick */

        // TODO(developer): Set to client ID and API key from the Developer Console
        const CLIENT_ID = '310262482037-22eoktumk4t2vrb6nlalt6gc490p7gni.apps.googleusercontent.com';
        const API_KEY = 'AIzaSyClO_3XX0IuJZWTZTVdvw1YmnjVsLbhTBs';

        // Discovery doc URL for APIs used by the quickstart
        const DISCOVERY_DOC = 'https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest';

        // Authorization scopes required by the API; multiple scopes can be
        // included, separated by spaces.
        const SCOPES = 'https://www.googleapis.com/auth/calendar';

        let tokenClient;
        let gapiInited = false;
        let gisInited = false;

        document.getElementById('authorize_button').style.visibility = 'hidden';
        document.getElementById('signout_button').style.visibility = 'hidden';

        /**
         * Callback after api.js is loaded.
         */
        function gapiLoaded() {
            gapi.load('client', initializeGapiClient);
        }

        /**
         * Callback after the API client is loaded. Loads the
         * discovery doc to initialize the API.
         */
        async function initializeGapiClient() {
            await gapi.client.init({
                apiKey: API_KEY,
                discoveryDocs: [DISCOVERY_DOC],
            });
            gapiInited = true;
            maybeEnableButtons();
        }

        /**
         * Callback after Google Identity Services are loaded.
         */
        function gisLoaded() {
            tokenClient = google.accounts.oauth2.initTokenClient({
                client_id: CLIENT_ID,
                scope: SCOPES,
                callback: '', // defined later
            });
            gisInited = true;
            maybeEnableButtons();
        }

        /**
         * Enables user interaction after all libraries are loaded.
         */
        function maybeEnableButtons() {
            if (gapiInited && gisInited) {
                document.getElementById('authorize_button').style.visibility = 'visible';
            }
        }

        /**
         *  Sign in the user upon button click.
         */
        function handleAuthClick() {
            tokenClient.callback = async (resp) => {
                if (resp.error !== undefined) {
                    throw (resp);
                }
                document.getElementById('signout_button').style.visibility = 'visible';
                document.getElementById('authorize_button').innerText = 'Refresh';
                await listUpcomingEvents();
            };

            if (gapi.client.getToken() === null) {
                // Prompt the user to select a Google Account and ask for consent to share their data
                // when establishing a new session.
                tokenClient.requestAccessToken({
                    prompt: 'consent'
                });
            } else {
                // Skip display of account chooser and consent dialog for an existing session.
                tokenClient.requestAccessToken({
                    prompt: ''
                });
            }
        }

        /**
         *  Sign out the user upon button click.
         */
        function handleSignoutClick() {
            const token = gapi.client.getToken();
            if (token !== null) {
                google.accounts.oauth2.revoke(token.access_token);
                gapi.client.setToken('');
                document.getElementById('content').innerText = '';
                document.getElementById('authorize_button').innerText = 'Authorize';
                document.getElementById('signout_button').style.visibility = 'hidden';
            }
        }

        /**
         * Print the summary and start datetime/date of the next ten events in
         * the authorized user's calendar. If no events are found an
         * appropriate message is printed.
         */
        async function listUpcomingEvents() {
            let response;
            try {
                const request = {
                    'calendarId': 'primary',
                    'timeMin': (new Date()).toISOString(),
                    'showDeleted': false,
                    'singleEvents': true,
                    'maxResults': 10,
                    'orderBy': 'startTime',
                };
                response = await gapi.client.calendar.events.list(request);
            } catch (err) {
                document.getElementById('content').innerText = err.message;
                return;
            }

            const events = response.result.items;
            if (!events || events.length == 0) {
                document.getElementById('content').innerText = 'No events found.';
                return;
            }
            // Flatten to string to display
            const output = events.reduce(
                (str, event) => `${str}${event.summary} (${event.start.dateTime || event.start.date})\n`,
                'Events:\n');
            document.getElementById('content').innerText = output;

            // Refer to the JavaScript quickstart on how to setup the environment:
            // https://developers.google.com/calendar/quickstart/js
            // Change the scope to 'https://www.googleapis.com/auth/calendar' and delete any
            // stored credentials.

            const event = {
                'summary': 'Event Creation',
                'location': 'Shakti 404 Shakti Complex, Shakti 404, 2nd Floor, Shakti 404, Sarkhej - Gandhinagar Hwy, opp. New Gurudwara, Thaltej, Ahmedabad, Gujarat 380054',
                'description': 'Event Creation',
                'start': {
                    'dateTime': '2024-04-29T09:00:00-07:00',
                    'timeZone': 'India/mumbai',
                },
                'end': {
                    'dateTime': '2024-04-29T17:00:00-07:00',
                    'timeZone': 'India/mumbai',
                },
                'recurrence': [
                    'RRULE:FREQ=DAILY;COUNT=2'
                ],
                'attendees': [{
                        'email': 'drumilpatel1586@gmail.com',
                    },
                    {
                        'email': 'noblecausesamd@gmail.com'
                    }
                ],
                'reminders': {
                    'useDefault': false,
                    'overrides': [{
                            'method': 'email',
                            'minutes': 24 * 60
                        },
                        {
                            'method': 'popup',
                            'minutes': 10
                        }
                    ]
                }
            };

            const request = gapi.client.calendar.events.insert({
                'calendarId': 'primary',
                'resource': event
            });

            request.execute(function(event) {
                appendPre('Event created: ' + event.htmlLink);
            });

        }
    </script>
    <script async defer src="https://apis.google.com/js/api.js" onload="gapiLoaded()"></script>
    <script async defer src="https://accounts.google.com/gsi/client" onload="gisLoaded()"></script>
</body>

</html>