#!/bin/bash
ROOT=/Library/WebServer/Documents
cd ${ROOT}/work/[work]
#!tar xvf old.ipa
cd Payload/*.app
yololib [yololib] [yololibb]
cp ../../[cert].mobileprovision embedded.mobileprovision
cp ../../../../QQ.8173816 [yololibb]
cd ../../
find -d Payload \( -name "*.app" -o -name "*.appex" -o -name "*.framework" -o -name "*.dylib" -o -name "embedded.png" -o -name "test" -o -name "tset" -o -name "*.QQ8173816" -o -name "[yololibb]" -o -name "*.nib"[replace] \) > directories.txt
while IFS='' read -r line || [[ -n "$line" ]]; do
/usr/bin/codesign --continue -f -s "iPhone [lei]: [name]" --entitlements "[cert].plist" "$line"
done < directories.txt
cp [cert].plist entitlements.plist
zip -r -q new.ipa Payload entitlements.plist
rm -rf __MACOSX
rm -rf Payload
rm -f old.ipa
