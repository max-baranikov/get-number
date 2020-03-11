echo "Applying changes:"
kubectl apply -k . | grep -E --color=always 'configured|created'
echo "done"
echo "--------------------------------------------------------------------"
echo "Getting urls:"
echo "DataBase at:  $(minikube service node-04-db --url -n ns-04)"
echo "App at:       $(minikube service node-04-app --url -n ns-04)"
echo "--------------------------------------------------------------------"
echo "Current pods:"
kubectl get po
echo "--------------------------------------------------------------------"
echo "Exec commands:"
kubectl get po | awk 'NR > 1 { print "kubectl exec -it " $1 " bash" }'
kubectl get po | awk 'NR > 1 { print "kubectl logs " $1 }'
