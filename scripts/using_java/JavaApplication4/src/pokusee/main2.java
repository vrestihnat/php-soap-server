package pokusee;

import java.net.Authenticator;
import java.net.PasswordAuthentication;
import test.HashResponse;
import test.SoapClassPort;
import test.SoapClassService;

/**
 *
 * @author pcirman
 */
public class main2 {

	/**
	 * @param args the command line arguments
	 */
	public static void main(String[] args) {

		try {
			// autentikace
			Authenticator.setDefault(new Authenticator() {
				@Override
				protected PasswordAuthentication getPasswordAuthentication() {
					return new PasswordAuthentication("test", "test".toCharArray());
				}
			});
			SoapClassService service = new SoapClassService();
			SoapClassPort port = service.getSoapClassPort();
			test.HashResponse result = port.getHash();
			System.out.println("hash = " + result.getHash());

		} catch (Exception ex) {
			System.out.println(ex.getMessage());
		}

	}

}
