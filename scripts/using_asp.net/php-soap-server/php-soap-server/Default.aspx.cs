using System;
using System.Collections;
using System.Configuration;
using System.Data;
using System.Linq;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Xml.Linq;
using System.ServiceModel;
using System.ServiceModel.Channels;
using System.Text;


namespace php_soap_server
{
    public partial class _Default : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

            PhpServer.SoapClassPortClient pc = new PhpServer.SoapClassPortClient();

            byte[] credentialBuffer = new UTF8Encoding().GetBytes("test:test");
            string b64code = Convert.ToBase64String(credentialBuffer);
            PhpServer.HashResponse resp = null;
            string dt = "";
            using (new OperationContextScope(pc.InnerChannel))
            {
                // Add a SOAP Header to an outgoing request

                //MessageHeader aMessageHeader = MessageHeader.CreateHeader("Authorization", string.Empty, "Basic c2FwOmVyZXJld3J3cg==");

                //OperationContext.Current.OutgoingMessageHeaders.Add(aMessageHeader);

                // Add a HTTP Header to an outgoing request

                HttpRequestMessageProperty requestMessage = new HttpRequestMessageProperty();

                requestMessage.Headers["Authorization"] = String.Format("Basic {0}", b64code);

                OperationContext.Current.OutgoingMessageProperties[HttpRequestMessageProperty.Name] = requestMessage;
                resp = pc.getHash();
                dt = pc.getDateTime();
            }

            Hash.Text = resp.hash;
            Url.Text = resp.url;
            CreatedBy.Text = resp.createdBy;
            DateTime dtm = DateTime.Parse(dt);
            Dt.Text = dtm.ToString("dd.MM.yyyy HH:mm:ss");

        }
    }
}
