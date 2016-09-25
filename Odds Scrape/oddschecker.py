# oddschecker module

from bs4 import BeautifulSoup
from urllib import request
import re

class OddsChecker:
	def __init__(self):
		self.home = "http://www.oddschecker.com"
		self.horse_home = self.home + "/horse-racing"
		return

	# get the soup of a webpage
	def prepareSoup(self, url):
		return BeautifulSoup(request.urlopen(url).read(), "html.parser")

	# list of race links from home page
	def getActiveRaceLinks(self):
		soup = self.prepareSoup("http://www.oddschecker.com/horse-racing")
		return [time['href'] for time in soup.find_all(class_='race-time')]

	# get bookies from a race page url
	def getBookiesFrom(self, url):
		soup = self.prepareSoup(self.home + url)
		tds = soup.find(class_="eventTableHeader").children
		bookies = []
		for td in tds:
			if(td.has_attr('data-bk')):
				bookies.append(td.find('a')['title'])
		return bookies

	# get the bookies (uses first race page linked on home page)
	def getBookies(self):
		homesoup = self.prepareSoup(self.horse_home)
		return self.getBookiesFrom(homesoup.find(class_='race-time')['href'])

	# get the venue and starting time of a race
	def getRaceInfo(self, url):
		parts = url.split("/")
		parts[2] = re.sub(r'[^a-zA-Z]', '', parts[2])
		return {'venue': parts[2], 'time': parts[3]}

	# get a race's runners and their odds
	def getRunnersFrom(self, url):
		bookies = self.getBookiesFrom(url)
		soup = self.prepareSoup(self.home + url)
		rows = soup.tbody.children

		runners = []
		for row in rows:
			runner = {'odds': {}}
			i = 0
			for cell in row.children:
				if(cell['class'][0] == 'sel'):
					runner['name'] = cell.a.string
				elif(cell.has_attr('data-hcap')):
					runner['odds'][bookies[i]] = cell.string
					i = i + 1
			runners.append(runner)
		return runners