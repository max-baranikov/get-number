status="$(minikube status | grep -c 'Stopped')"

if [ "$status" = "0" ];
then
  echo "Minikube already started"
else
  echo "Starting minikube"
  minikube start
  sleep 1
fi

minikube service list
minikube dashboard --url
