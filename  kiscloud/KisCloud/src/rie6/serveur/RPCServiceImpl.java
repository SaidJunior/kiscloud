package rie6.serveur;

import rie6.client.model.RPCservice;
import rie6.serveur.controleur.ControleurServeur;
import rie6.serveur.model.CheckThisLoginNpwd;
import rie6.serveur.model.TestCookie;

import com.google.gwt.user.server.rpc.RemoteServiceServlet;

@SuppressWarnings("serial")
public class RPCServiceImpl extends RemoteServiceServlet implements RPCservice {
	ControleurServeur controleurServeur = new ControleurServeur();
	@Override
	public String[] testThisCookie(String id_cookie) {
		TestCookie testCookie = new TestCookie(controleurServeur,id_cookie);
		return testCookie.getRetour();
	}

	@Override
	public String[] checkThisLoginNpwd(String login, String pwd) {
		CheckThisLoginNpwd checkThisLoginNpwd = new CheckThisLoginNpwd(controleurServeur,login,pwd);
		return checkThisLoginNpwd.getRetour();
	}

}
