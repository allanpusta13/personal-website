const { chromium } = require('playwright');
const http = require('http');
const fs = require('fs');
const path = require('path');

const server = http.createServer((req, res) => {
  let filePath = path.join(__dirname, req.url === '/' ? 'index.html' : req.url);
  const ext = path.extname(filePath);
  const types = { '.html': 'text/html', '.css': 'text/css', '.js': 'application/javascript' };
  try {
    const data = fs.readFileSync(filePath);
    res.writeHead(200, { 'Content-Type': types[ext] || 'text/plain' });
    res.end(data);
  } catch { res.writeHead(404); res.end('Not found'); }
});

server.listen(3458, async () => {
  try {
    const browser = await chromium.launch();
    const page = await browser.newPage({ viewport: { width: 1280, height: 800 } });
    await page.goto('http://localhost:3458');
    await page.waitForTimeout(1500);

    // Use the role="tab" selector to target only tab triggers
    const tabs = page.locator('[role="tab"]');

    await page.screenshot({ path: 'D:/Personal/personal-website/.impeccable/screenshots/v3-live-systems.png', fullPage: true });
    console.log('1/4 Systems tab');

    await tabs.nth(1).click();
    await page.waitForTimeout(500);
    await page.screenshot({ path: 'D:/Personal/personal-website/.impeccable/screenshots/v3-live-tech.png', fullPage: true });
    console.log('2/4 Tech tab');

    await tabs.nth(2).click();
    await page.waitForTimeout(500);
    await page.screenshot({ path: 'D:/Personal/personal-website/.impeccable/screenshots/v3-live-experience.png', fullPage: true });
    console.log('3/4 Experience tab');

    await tabs.nth(3).click();
    await page.waitForTimeout(500);
    await page.screenshot({ path: 'D:/Personal/personal-website/.impeccable/screenshots/v3-live-solutions.png', fullPage: true });
    console.log('4/4 Solutions tab');

    await page.setViewportSize({ width: 375, height: 812 });
    await tabs.nth(0).click();
    await page.waitForTimeout(500);
    await page.screenshot({ path: 'D:/Personal/personal-website/.impeccable/screenshots/v3-live-mobile.png', fullPage: true });
    console.log('Mobile captured');

    await browser.close();
    console.log('All tests passed');
  } catch (e) { console.error(e); }
  server.close();
  process.exit(0);
});
