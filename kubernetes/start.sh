status="$(minikube status)"
running="$(echo $status | grep -c 'Running')"
configured="$(echo $status | grep -c 'Configured')"

if [ "$running" != "0" ] && [ "$configured" != "0" ]; then
  echo "Minikube already started"
else
  echo "Starting minikube"
  minikube start
  sleep 1
fi

echo "Enabling ingress"
minikube addons enable ingress

echo "Service list"
minikube service list

echo "Dashboard"
minikube dashboard --url
