def load_config(path, conf)
  root = File.dirname(File.dirname(__FILE__))

  if !File.exists?(File.join(root, path))
    return conf
  end

  tmp = YAML.load(
    File.open(
      File.join(root, path),
      File::RDONLY
    ).read
  )

  if(tmp.is_a?(Hash))
    return conf.merge!(tmp)
  end

  return conf
end


def install_plugin(plugin)
  system "vagrant plugin install #{plugin}" unless Vagrant.has_plugin? plugin
end


module OS
  def self.windows?
    Vagrant::Util::Platform.windows?
  end

  def self.mac?
    (/darwin/ =~ Vagrant::Util::Platform.platform) != nil
  end

  def self.unix?
    !Vagrant::Util::Platform.platform
  end

  def self.linux?
    self.unix? and not self.mac?
  end
end
