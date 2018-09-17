# removes any sobrepeso container if exists
docker rm -f sobrepeso

# removes sobrepeso image if exists
docker rmi sobrepeso

# clean the docker env from idle images
docker image prune -y

# clean the docker env from idle volumes
docker volume prune -y

# it builds the dockerfile image
docker build -t sobrepeso -f Dockerfile .

# starts the sobrepeso app in a container
docker run --name sobrepeso \
-p 80:80 \
-v "$(pwd)/sobrepeso":/var/www/html/sobrepeso/ \
-d sobrepeso