//라이브러리 불러오기
const puppeteer = require("puppeteer");
//파일 시스템 모듈
const fsp = require("fs");

//자동으로 스크롤 하도록
const autoScroll = async (page) => {
    await page.evaluate(async () => {
        await new Promise((resolve, reject) => {
            var totalHeight = 0;
            var distance = 100;
            var timer = setInterval(() => {
                var scrollHeight = document.body.scrollHeight;
                window.scrollBy(0, distance);
                totalHeight += distance;

                if (totalHeight >= scrollHeight) {
                    clearInterval(timer);
                    resolve();
                }
            }, 30);
        });
    });
};
//데이터 담을 배열 선언
//const scrappedDatas = [];
(async () => {
    function delay(ms) {
        return new Promise((resolve) => {
            setTimeout(resolve, ms);
        });
    }

    //페이징 번호 위해
    const extractNews = async (url) => {
        const page = await browser.newPage();
        await page.goto(url, {
            waitUntil: "networkidle2",
        });
        //이미지 로드 시간 대기
        await page.waitForSelector("a img");
        await autoScroll(page);
        await delay(10000);
        const html = await page.content();
        //데이터 크롤링
        const newsOnPage = await page.evaluate(() =>
            Array.from(
                // document.querySelectorAll("#news_result_list > li > div.news_wrap")
                document.querySelectorAll(
                    "#contents > div.search-result-section.first-child > ul > li > dl"
                )
            ).map((dl) => ({
                title: dl.querySelector("dt a").innerText.trim(),
                link: dl.querySelector("dt a").href,
                date: dl.querySelector("dd.date").innerText.trim(),
                contents: dl.querySelector("dd.detail").innerText.trim(),
                image: dl.querySelector("a img").src,
            }))
        );
        //제이슨으로 데이터 파일 만듦.
        await fsp.writeFileSync(
            "newsinfothird.json",
            JSON.stringify(newsOnPage),
            "utf-8",
            (err, data) => {
                if (err) {
                    console.err(err);
                } else {
                    console.log("파일 생성됨");
                }
            }
        );
        await page.close();
        //또 크롤링 해야하는지 결정. 뉴스가 다음 페이지에 없으면 끝내기
        if (newsOnPage.length < 1) {
            //빈 배열 반환. 크롤링 끝
            return newsOnPage;
        } else {
            //다음 페이지로 넘어가기
            //다음 url
            const nextPageNumber = parseInt(url.match(/pageseq=(\d+)$/)[1], 10) + 1;

            const nextUrl =
                "http://search.hani.co.kr/Search?command=query&keyword=%ED%95%B4%EB%A6%AC%ED%8F%AC%ED%84%B0&media=news&submedia=&sort=d&period=all&datefrom=2000.01.01&dateto=2020.05.26&pageseq=" + nextPageNumber;

            return newsOnPage.concat(await extractNews(nextUrl));
            //기사 제목, 내용 배열로 넣기nod
        }

    };

    const browser = await puppeteer.launch({
        headless: false,
        args: ["--no-sandbox", "--disable-setuid-sandbox"],
        slowMo: 250,
        //브라우저 인스턴스가 시작될 때까지 대기하는 시간.
        timeout: 30000,
    });

    const firstUrl =
        "http://search.hani.co.kr/Search?command=query&keyword=%ED%95%B4%EB%A6%AC%ED%8F%AC%ED%84%B0&media=news&submedia=&sort=d&period=all&datefrom=2000.01.01&dateto=2020.05.26&pageseq=2";
    const news = await extractNews(firstUrl);

    //이 다음에 데이터 업데이트

    // 브라우저 닫기
    await browser.close();

})();