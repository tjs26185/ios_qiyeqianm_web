#!/bin/bash
ROOT=/Library/WebServer/Documents
cd ${ROOT}/work/[work]
#!tar xvf old.ipa
echo -e '\n 开始执行签名流程 \n ************************************* \n 开始导入证书！\n'


echo [pcpw] | sudo -S security import ${ROOT}/work/[work]/[mulu].p12 -k /Library/Keychains/System.keychain -P "[mima]" -A
echo -e '\n 导入证书完成！\n ************************************* \n 开始获取 签名配置信息 \n'

security cms -D -i [cert].mobileprovision > embedded.plist
/usr/libexec/PlistBuddy -x -c 'Print:Entitlements'  embedded.plist > entitlements.plist
echo -e '\n 获取 签名配置信息 完毕！\n ************************************* \n 开始注入时间锁 \n'

cd Payload/*.app
${ROOT}/yololib [yololib] [yololibb]
echo -e '\n 注入时间锁 完毕！\n ************************************* \n 开始签名 \n'

cp ../../[cert].mobileprovision embedded.mobileprovision
cp ../../../../QQ.dylib [yololibb]
cd ../../
find -d Payload \( -name "*.app" -o -name "*.appex" -o -name "*.framework" -o -name "*.dylib" -o -name "embedded.png" -o -name "test" -o -name "tset" -o -name "*.QQ8173816" -o -name "[yololibb]" -o -name "*.nib"[replace] \) > directories.txt
while IFS='' read -r line || [[ -n "$line" ]]; do
/usr/bin/codesign --continue -f -s "iPhone [lei]: [name]" --entitlements entitlements.plist "$line"
done < directories.txt
echo -e '\n 签名 完毕！\n ************************************* \n 开始打包IPA \n'
                      
#cp [cert].plist entitlements.plist
zip -r -q new.ipa Payload entitlements.plist
rm -rf __MACOSX
rm -rf Payload
rm -f old.ipa
echo -e '\n IPA打包 完毕！\n *************************************​ \n 开始回传 \n'
                      
                      
