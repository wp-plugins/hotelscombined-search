=== HotelsCombined Search Widget ===
Contributors: gbyoung
Tags: widget,widgets,hotels,search,hotelscombined
Requires at least: 2.3
Tested up to: 3.0.4
Stable tag: 2.0

Search and Compare 100+ travel sites for 1000s of Hotel deals worldwide – Hotels Combined

== Description ==
Search and Compare 100+ travel sites for 1000s of Hotel deals worldwide – Hotels Combined With this official Hotels Combined™ widget, you can compare over 100 of the best hotel reservation sites to find the cheapest accommodation deals at any destination. With a database of more than 200,000 hotels from 195 countries, HotelsCombined.com™ is the world’s leading hotel search engine visited by over 6 million people each month.

== Installation ==

1. Upload the widget to your site using by first clicking on Plugins, then Add-New, then Upload, the choose the widget zip file from your local directory.
or 
1. Download and unzip hcsearch-widget.zip 
2. Upload the folder containing `hcsearch-widget.php` to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress

1. To add the widget on a sidebar, browse to Design > Widgets and add the 'HotelsCombined Search Widget" to desired sidebar. Configure the Title, Affiliate ID, and Skin and save your changes.

1. To add the widget to any post or page just add the markup `[hcsearch]affiliateId,city_idx,brand_id,label,customurl[/hcsearch]`, for instance `[hcsearch]20032,2[/hcsearch]`.  The affiliate id can be obtained from hotelscombined.com.  The city_idx is a number between 0 and 7 corresponding to 0 -> New York (Blue), 1 -> Bangkok (Bright Pink), 2 -> Sydney (Light Blue), 3 -> Berlin (Orange), 4 -> Dubai (Purple), 5 -> Hong Kong (Light Blue), 6 -> Paris (Orange), 7 -> London (Blue). The customurl is only needed for those affiliates with cname servers (ex.  http://hotels.example.com).  Otherwise, don't include this parameter.

== Frequently Asked Questions ==

= How do I add the widget to a blog-post =

To add the widget to any post or page just add the markup `[hcsearch]affiliateId,city_idx,brand_id,label[/hcsearch]`, for instance `[hcsearch]20032,2[/hcsearch]`. Note that the parameters are not mandatory, but must be specified from left to right in the order shown.  That is, if brand_id is given then both the affiliateId and city_idx must be specified as well.  If unspecified, the affiliate ID will not be used for redirects to hotelscombined.com.  Likewise, if the city_idx is unspecified the widget will default to the Sydney skin. The closing [/hcsearch] tag is mandatory.  The affiliateId may be obtained from hotelscombined.com.  The city_idx is a number between 0 and 7 corresponding to the following skins for the widget 0 -> New York (Blue), 1 -> Bangkok (Bright Pink), 2 -> Sydney (Light Blue), 3 -> Berlin (Orange), 4 -> Dubai (Purple), 5 -> Hong Kong (Light Blue), 6 -> Paris (Orange), 7 -> London (Blue).

= Can I add multiple widgets on a Post or Page? =

Yes you can. Just add multiple `[hcsearch]` tags where required. All of these can be configured independently.

= Can I add multiple HotelsCombined Search Widgets on sidebar? =

Unfortunately no. As of now you can only add one instance of HotelsCombined Search Widget on sidebar.

== Screenshots ==

1. Configure your HotelsCombined Search Widget. 
2. This is how the widget looks like on sidebar after configuration. 

== Changelog ==

*	**1.0**: Initial public release.