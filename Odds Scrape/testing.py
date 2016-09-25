# test scraping results

from oddschecker import OddsChecker

oc = OddsChecker()
links = oc.getActiveRaceLinks()

bookies = oc.getBookies()
for bookie in bookies:
	print(bookie)

# runners from the first race linked on home page
runners = oc.getRunnersFrom(links[0])
for runner in runners:
	print(runner)