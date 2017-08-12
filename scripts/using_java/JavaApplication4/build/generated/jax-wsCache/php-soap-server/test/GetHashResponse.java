
package test;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlType;


/**
 * <p>Java class for anonymous complex type.
 * 
 * <p>The following schema fragment specifies the expected content contained within this class.
 * 
 * <pre>
 * &lt;complexType>
 *   &lt;complexContent>
 *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *       &lt;sequence>
 *         &lt;element name="getHashResult" type="{http://bflm.eu/php-soap-server/soap.php}HashResponse"/>
 *       &lt;/sequence>
 *     &lt;/restriction>
 *   &lt;/complexContent>
 * &lt;/complexType>
 * </pre>
 * 
 * 
 */
@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "", propOrder = {
    "getHashResult"
})
@XmlRootElement(name = "getHashResponse")
public class GetHashResponse {

    @XmlElement(required = true)
    protected HashResponse getHashResult;

    /**
     * Gets the value of the getHashResult property.
     * 
     * @return
     *     possible object is
     *     {@link HashResponse }
     *     
     */
    public HashResponse getGetHashResult() {
        return getHashResult;
    }

    /**
     * Sets the value of the getHashResult property.
     * 
     * @param value
     *     allowed object is
     *     {@link HashResponse }
     *     
     */
    public void setGetHashResult(HashResponse value) {
        this.getHashResult = value;
    }

}
