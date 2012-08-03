package rie6.client.model;

import com.google.gwt.user.client.rpc.AsyncCallback;

public interface RPCserviceAsync {

	void testThisCookie(String id_cookie, AsyncCallback<String[]> callback);

	void checkThisLoginNpwd(String login, String pwd,AsyncCallback<String[]> callback);

}
