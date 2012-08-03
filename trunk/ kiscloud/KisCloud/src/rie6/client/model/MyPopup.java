package rie6.client.model;

import com.google.gwt.user.client.Timer;
import com.google.gwt.user.client.ui.DecoratedPopupPanel;
import com.google.gwt.user.client.ui.HasHorizontalAlignment;
import com.google.gwt.user.client.ui.Label;

/**
 * Affiche un popup personalisé qui se cache au bout de 3 secondes
 * @author nico
 *
 */
public class MyPopup extends DecoratedPopupPanel {

	public MyPopup(String string) {
		this.setWidth("350px");
		this.setHeight("50px");
		Label infoAafficher = new Label(string);
		this.setWidget(infoAafficher);
		infoAafficher.setAutoHorizontalAlignment(HasHorizontalAlignment.ALIGN_CENTER);
		
		this.setStyleName("myPopup");	
		this.center();
		this.show();
		Timer timer = new Timer(){
			public void run(){
				cacher();
			}
		};
		
		timer.schedule(3000);
	}

	protected void cacher() {
		this.hide();
		
	}

}
