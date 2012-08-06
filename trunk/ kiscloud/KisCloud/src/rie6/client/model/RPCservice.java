package rie6.client.model;

import java.util.List;

import rie6.client.admin.model.User;

import com.google.gwt.user.client.rpc.RemoteService;
import com.google.gwt.user.client.rpc.RemoteServiceRelativePath;
/**
 * Interface RPC. Contient la liste des methodes utilisables sur le serveur
 * @author nico
 *
 */
@RemoteServiceRelativePath("RPCservice")
public interface RPCservice extends RemoteService {
	
	String[] testThisCookie(String id_cookie);

	String[] checkThisLoginNpwd(String login, String pwd);
	
	public List<User> getListUser();

}
