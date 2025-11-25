<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" 
                xmlns:html="http://www.w3.org/TR/REC-html40"
                xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
  
  <xsl:template match="/">
    <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <title>SIPANDA Kesbangpol Buleleng</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
          body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
          }
          .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
          }
          h1 {
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
          }
          .info {
            background: #e8f4f8;
            padding: 15px;
            border-left: 4px solid #3498db;
            margin-bottom: 25px;
            border-radius: 4px;
          }
          table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
          }
          th {
            background-color: #3498db;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
          }
          td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
          }
          tr:hover {
            background-color: #f8f9fa;
          }
          a {
            color: #3498db;
            text-decoration: none;
          }
          a:hover {
            text-decoration: underline;
            color: #2980b9;
          }
          .url-cell {
            word-break: break-all;
          }
          .footer {
            margin-top: 30px;
            text-align: center;
            color: #7f8c8d;
            font-size: 12px;
          }
        </style>
      </head>
      <body>
        <div class="container">
          <h1>🗺️ SIPANDA Kesbangpol Buleleng</h1>
          
          <div class="info">
            <strong>Tentang Sitemap:</strong> Halaman ini berisi daftar semua URL dalam sistem informasi SIPANDA Kesbangpol Buleleng yang dapat diakses oleh mesin pencari.
          </div>

          <table>
            <thead>
              <tr>
                <th style="width: 60%;">URL</th>
                <th style="width: 15%;">Terakhir Diubah</th>
                <th style="width: 15%;">Frekuensi Update</th>
                <th style="width: 10%;">Prioritas</th>
              </tr>
            </thead>
            <tbody>
              <xsl:for-each select="sitemap:urlset/sitemap:url">
                <tr>
                  <td class="url-cell">
                    <a href="{sitemap:loc}">
                      <xsl:value-of select="sitemap:loc"/>
                    </a>
                  </td>
                  <td>
                    <xsl:value-of select="sitemap:lastmod"/>
                  </td>
                  <td>
                    <xsl:value-of select="sitemap:changefreq"/>
                  </td>
                  <td>
                    <xsl:value-of select="sitemap:priority"/>
                  </td>
                </tr>
              </xsl:for-each>
            </tbody>
          </table>
          
          <div class="footer">
            <p>Total URL: <strong><xsl:value-of select="count(sitemap:urlset/sitemap:url)"/></strong></p>
            <p>© 2025 SIPANDA Kesbangpol Buleleng</p>
          </div>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>