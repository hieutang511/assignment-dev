# Dependencies
  - Install [Docker](https://docs.docker.com/engine/installation/)
  - Install [Docker Compose](https://docs.docker.com/compose/install/)
  - Add `127.0.0.1  assignment.dev, api.assignment.dev` to `/etc/hosts`

# Setup
  - Clone the project
  - Open a Terminal, go into project directory
  - Run docker with this command
  `docker-compose up`
  - SSH into docker container
  `docker exec -it assignment-server bash`
  - Initiate project environment, select Development (just first time)
  `cd /var/www/assignment`
  `php init`
  - Apply migrations
  `./yii migrate`
  
##### How to turn docker off
- Open another Terminal and go into project directory (or Ctrl+C at the current terminal)
 - Turn docker of with this command
  `docker-compose down`

# Testing
 - Open "assignment.dev" in a browser