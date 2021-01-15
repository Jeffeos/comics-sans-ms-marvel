# comics-sans-ms-marvel

## Prerequisites
1. PHP 7.3
2. Symfony 5
3. Password to access the API Keys or your own Marvel API Keys:

/!\ You can get your API Keys at https://developer.marvel.com/documentation/getting_started
Or you can contact me, as Marvel specifically requests not to share our API keys publicly:

`Please keep your private key private! Do not store your private key in publicly available code or repositories that are accessible to the public. Do not accidentally leave it at the bar.`


## Deployment
1. Clone this project
2. Run composer install
3. Unzip the .env.local.zip file with the password I provided
4. Launch your local server, please type: `symfony server:start`
(optional) 5. You can launch phpunit tests with this command: `phpunit tests\CharacterTest.php`

/!\ You can get your API Keys at https://developer.marvel.com/documentation/getting_started
Or you can contact me as Marvel specifically requests not to share our API keys:

`Please keep your private key private! Do not store your private key in publicly available code or repositories that are accessible to the public. Do not accidentally leave it at the bar.`

## What this app does
I. Display Marvel heroes: this app uses the Marvel API (https://developer.marvel.com/documentation/getting_started) to display heroes from the Marvel universe.
- When the index page is launched, the API provides the informations regarding the characters.
- By clicking on a character's name, you can access his.her informations. Each time you access a new character, an request is sent for his information.

II. Approach:
- I decided to focus on the backend part of this project by implementing all the best practices I studied and practiced at my first job.
- This website has been made with PHP Symfony's squeletton, phpUnit and bootstrap.

III. Further developments:
- The visual aspect of this app should be updated
- Add a feature to select your favorite characters
- Add page numbers and the possibility to browse through the different pages 
- Security: The parameter used to access a character's page should be a slug instead of its ID. 
- Tests: Implement tests for the appController

## Have fun!

