package rie6.client.admin.controleur;

import java.util.List;

import com.google.gwt.core.client.GWT;
import com.google.gwt.rpc.client.RpcService;
import com.google.gwt.user.client.rpc.AsyncCallback;



import rie6.client.admin.model.User;
import rie6.client.admin.vue.AdminPortal;
import rie6.client.model.RPCservice;
import rie6.client.model.RPCserviceAsync;

public class ControllerAdmin {
	
	private AdminPortal adminPortal;
	
	public ControllerAdmin(){
		
	}
	
	
	public AdminPortal getAdminPortal() {
		return adminPortal;
	}

	public void setAdminPortal(AdminPortal adminPortal) {
		this.adminPortal = adminPortal;
	}

	public void getListUser (){
		
		//Déclaration du service
		RPCserviceAsync rpcServiceAsync = GWT.create(RPCservice.class);
		
		// Creation du callback pour recup la reponse serveur
		AsyncCallback<List<User>> asyncCallback = new AsyncCallback<List<User>>() {

			@Override
			public void onFailure(Throwable caught) {
				System.out.println("le systeme ne repond pas , PEPIN !! (ControllerAdmin)");
			}

			@Override
			public void onSuccess(List<User> result) {
				System.out.println(" le serveur me retourne un truc (ControllerAdmin)");	
				
			}
		};
		
		rpcServiceAsync.getListUser(asyncCallback);
	
	}
	
}
