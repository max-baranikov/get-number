echo "Applying changes:"
kubectl apply -k . | grep -E --color=always 'configured|created'
echo "done"
echo "--------------------------------------------------------------------"
echo "Getting urls:"
echo "DataBase at:  $(minikube service node-04-db --url -n ns-04)"
echo "App at:       $(minikube service node-04-app --url -n ns-04)"
echo "--------------------------------------------------------------------"
echo "Current pods:"
kubectl get po -n ns-04
echo "--------------------------------------------------------------------"
echo "Exec commands:"
kubectl get po -n ns-04 | awk 'NR > 1 { print "kubectl exec -n ns-04 -it " $1 " -- bash" }'
kubectl get po -n ns-04 | awk 'NR > 1 { print "kubectl logs -n ns-04 " $1 }'
