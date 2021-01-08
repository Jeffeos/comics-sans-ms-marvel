# comics-sans-ms-marvel

## Prerequisites
1. PHP 7.3
2. Symfony 5

## Deployment
1. Clone this project
2. Run composer install
3. Create .env.local file and put the following informations in it:
- MARVEL_API_PUBLIC_KEY
- MARVEL_API_PRIVATE_KEY

You can get your API Keys at https://developer.marvel.com/documentation/getting_started

## What this app does
1. Display Marvel heroes: this app uses the Marvel API (https://developer.marvel.com/documentation/getting_started) to display heroes from the Marvel universe.
- When the index page is launched, the API provides the informations regarding the characters.
- By clicking on a character's name, you can access his.her informations. Each time you access a new character, an request is sent for his information.

2. Further developments:
- Security: The parameter used to access a character's page should be a slug instead of its ID. 
- Tests: Implement tests for the app

## Have fun!

